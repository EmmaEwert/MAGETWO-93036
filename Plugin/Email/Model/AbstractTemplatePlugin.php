<?php
namespace Baze\Patch225\Plugin\Email\Model;

class AbstractTemplatePlugin {
	private $area;
	private $emailConfig;

	public function __construct(\Magento\Email\Model\Template\Config $emailConfig) {
		$this->emailConfig = $emailConfig;
	}

	public function beforeSetForcedArea(\Magento\Email\Model\AbstractTemplate $subject, $templateId) {
		if (!isset($subject->area)) {
			$area = $this->emailConfig->getTemplateArea($templateId);
		} else {
			$area = $subject->area;
		}
		unset($subject->area);
		return $templateId;
	}

	public function afterSetForcedArea(\Magento\Email\Model\AbstractTemplate $subject, $result) {
		$result->area = $area;
		return $result;
	}
}
