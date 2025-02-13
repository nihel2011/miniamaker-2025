<?php

namespace App\Service;


use Stripe\Stripe;
use App\Entity\User;
use App\Entity\Subscription;
use Stripe\Checkout\Session;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SubscriptionRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PaymentService
{
    public function __construct(
        private ParameterBagInterface $params,
        private SubscriptionRepository $sr,
        private EntityManagerInterface $em,
        private HttpClientInterface $httpClient,
    ) {}

    public function setPayment(User $user, int $amount): string
{
    Stripe::setApiKey($this->params->get('STRIPE_SK'));

    $subscription = new Subscription();
    $subscription
        ->setClient($user)
        ->setAmount($amount)
        ->setFrequency($amount > 99 ? 'year' : 'month')
        ->setIsActive(true)  // Ajoutez ceci
    ;

    try {
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $amount * 100,
                    'recurring' => [
                        'interval' => $subscription->getFrequency(),
                    ],
                    'product_data' => [
                        'name' => 'Abonnement miniamaker',
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => $this->params->get('APP_URL') . '/subscription/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $this->params->get('APP_URL') . '/subscription/cancel',
            'client_reference_id' => $user->getId(),
        ]);

        // Sauvegardez l'abonnement en base
        $this->em->persist($subscription);
        $this->em->flush();

        return $checkout_session->url ?? 'TEST';
    } catch (\Throwable $th) {
        throw $th;
    }
}
}
                    