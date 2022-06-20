<?php

namespace App\Providers;

use App\Events\GoogleAds\GoogleAdsAdGroupCpvUpdated;
use App\Events\GoogleAdsAccountSuspended;
use App\Events\GoogleAdsAdGroupStatisticUpdated;
use App\Events\GoogleAdsInStreamAdApprovalStatusUpdated;
use App\Events\GoogleAdsInStreamAdCreationFailed;
use App\Events\GoogleAdsInStreamAdStatisticUpdated;
use App\Events\OrderCanceled;
use App\Events\OrderCompleted;
use App\Listeners\HandleApprovalStatusUpdating;
use App\Listeners\HandleInStreamAdCreationFailed;
use App\Listeners\PauseAccountCampaignsAndAdGroups;
use App\Listeners\PauseGoogleAdsAdGroups;
use App\Listeners\PauseGoogleAdsCampaigns;
use App\Listeners\UpdateGoogleAdsAccountGatherPeriod;
use App\Listeners\UpdateGoogleAdsCampaignBudget;
use App\Listeners\UpdateOrderStatistic;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderCompleted::class => [
            PauseGoogleAdsCampaigns::class,
            PauseGoogleAdsAdGroups::class,
        ],
        OrderCanceled::class => [
            PauseGoogleAdsCampaigns::class,
            PauseGoogleAdsAdGroups::class,
        ],
        GoogleAdsInStreamAdStatisticUpdated::class => [
            UpdateOrderStatistic::class,
        ],
        GoogleAdsInStreamAdApprovalStatusUpdated::class => [
            HandleApprovalStatusUpdating::class,
        ],
        GoogleAdsAccountSuspended::class => [
            PauseAccountCampaignsAndAdGroups::class,
        ],
        GoogleAdsAdGroupStatisticUpdated::class => [
            UpdateGoogleAdsAccountGatherPeriod::class,
        ],
        GoogleAdsInStreamAdCreationFailed::class => [
            HandleInStreamAdCreationFailed::class,
        ],
        GoogleAdsAdGroupCpvUpdated::class => [
            UpdateGoogleAdsCampaignBudget::class,
        ],
    ];
}
