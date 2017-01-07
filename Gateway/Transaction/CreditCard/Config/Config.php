<?php

namespace Webjump\BraspagPagador\Gateway\Transaction\CreditCard\Config;

use Webjump\BraspagPagador\Gateway\Transaction\Base\Config\Config as BaseConfig;
use Magento\Payment\Model\Method\AbstractMethod;

class Config extends BaseConfig implements ConfigInterface
{
    public function isAuthorizeAndCapture()
    {
        return (AbstractMethod::ACTION_AUTHORIZE_CAPTURE === $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_PAYMENT_ACTION));
    }

    public function getSoftDescriptor()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_SOFT_ACTION);
    }

    public function hasAntiFraud()
    {
        return $this->_getConfig(AntiFraudConfigInterface::XML_PATH_ACTIVE);
    }

    public function hasAvs()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_AVS_ACTIVE);
    }

    public function isAuthenticate3DsVbv()
    {
        return (bool) $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_3DS_VBV_AUTHENTICATE);
    }

    public function getReturnUrl()
    {
        $url = (string) str_replace('index.php/', '', $this->getStoreManager()->getStore()->getUrl($this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_RETURN_URL)));

        return substr($url, 0, -1);
    }

    public function getIdentityAttributeCode()
    {
        return $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_CUSTOMER_IDENTITY_ATTRIBUTE_CODE);
    }

    public function isSaveCardActive()
    {
        return (boolean) $this->_getConfig(self::CONFIG_XML_BRASPAG_PAGADOR_CREDITCARD_SAVECARD_ACTIVE);
    }

    /**
     * @deprecated
     */
	public function getSession()
    {
        return parent::getSession();
    }
}
