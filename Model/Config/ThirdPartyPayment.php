<?php

declare(strict_types=1);

namespace Swarming\SubscribePro\Model\Config;

use Magento\Store\Model\ScopeInterface;

class ThirdPartyPayment
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int|null $storeId
     * @return bool
     */
    public function isAllowed(int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            'swarming_subscribepro/third_party_payment/is_allowed',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @param int|null $storeId
     * @return array
     */
    public function getAllowedMethods(int $storeId = null): array
    {
        $allowedThirdPartyValue = $this->scopeConfig->getValue(
            'swarming_subscribepro/third_party_payment/allowed_methods',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        return $this->isAllowed($storeId) && !empty($allowedThirdPartyValue)
            ? explode(',', $allowedThirdPartyValue)
            : [];
    }
}
