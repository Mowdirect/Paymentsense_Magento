<?php
if (!Mage::getStoreConfig('payment/Paymentsense/active')) {
    class Paymentsense_Paymentsense_Block_Adminhtml_Sales_Order_Payment extends Mage_Adminhtml_Block_Sales_Order_Payment { }
}

if (Mage::getStoreConfig('payment/Paymentsense/active')) {
    class Paymentsense_Paymentsense_Block_Adminhtml_Sales_Order_Payment extends Mage_Adminhtml_Block_Sales_Order_Payment
    {
        public function setPayment($payment)
        {
            parent::setPayment($payment);
            $paymentInfoBlock = Mage::helper('payment')->getInfoBlock($payment);

            if ($payment->getMethod() == 'Paymentsense') {

                $paymentInfoBlock->setTemplate('payment/info/cc_paymentsense.phtml');
            }

            $this->setChild('info', $paymentInfoBlock);
            $this->setData('payment', $payment);
            return $this;
        }

        protected function _toHtml()
        {
            return $this->getChildHtml('info');
        }

    }
}
