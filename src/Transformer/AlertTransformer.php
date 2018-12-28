<?php
/**
 * AlertTransformer.php
 *
 * @date        28/12/18
 * @file        AlertTransformer.php
 */

namespace Fei\Service\Notification\Transformer;

use Fei\Service\Notification\Entity\Alert;
use Fei\Service\Notification\Entity\Alert\AbstractAlert;
use Fei\Service\Notification\Entity\Alert\Android;
use Fei\Service\Notification\Entity\Alert\Email;
use Fei\Service\Notification\Entity\Alert\Sms;
use Fei\Service\Notification\Entity\Alert\Rss;
use League\Fractal\TransformerAbstract;

/**
 * AlertTransformer
 */
class AlertTransformer extends TransformerAbstract
{
    /**
     * @param Alert $alert
     *
     * @return array
     */
    public function transform(Alert $alert) : array
    {
        return [
		'id' => $alert->getId(),
		'recipient' => $alert->getRecipient(),
		'notif_id' => $alert->getNotifId(),
		'created_at' => $alert->getCreatedAt(),
		'status' => $alert->getStatus(),
		'subject' => $alert->getSubject(),
		'message' => $alert->getMessage(),
	        'type' => $alert->getType()
        ];
    }

    /**
     * @param AlertRss $alertTyped
     *
     * @return Alert
     */
    public function transformRss(Rss $alertTyped) : Alert
    {
        $alert = new Alert();
        $alert->setMessage($alertTyped->getContent());
        $alert->setSubject($alertTyped->getSubject());
        $alert->setRecipient($alertTyped->getRecipient());
        $alert->setNotifId($alertTyped->getNotification()->getId());
        $alert->setType(Alert::ALERT_RSS);
        return $alert;
    }

    /**
     * @param AlertEmail $alertTyped
     *
     * @return Alert
     */
    public function transformEmail(Email $alertTyped) : Alert
    {
        $alert = new Alert();
        $alert->setMessage($alertTyped->getContent());
        $alert->setSubject($alertTyped->getSubject());
        $alert->setRecipient($alertTyped->getEmail());
        $alert->setNotifId($alertTyped->getNotification()->getId());
        $alert->setType(Alert::ALERT_EMAIL);
        return $alert;
    }

   /**
     * @param AlertSms $alertTyped
     *
     * @return Alert
     */
    public function transformAndroid(Android $alertTyped) : Alert
    {
        $alert = new Alert();
        $alert->setMessage($alertTyped->getMessage()->getNotification()->getBody());
        $alert->setSubject($alertTyped->getMessage()->getNotification()->getTitle());
        $alert->setRecipient($alertTyped->getMessage()->getTopic());
        $alert->setNotifId($alertTyped->getNotification()->getId());
        $alert->setType(Alert::ALERT_ANDROID);
        return $alert;
    }


    /**
     * @param AlertSms $alertTyped
     *
     * @return array
     */
    public function transformSms(Sms $alertTyped) : array
    {
	$alertArr = [];
	foreach ($alertTyped->getMessages() as $messages) {
	    foreach ($messages->getRecipients() as $recipient) {
		$alert = new Alert();
		$alert->setMessage($messages->getContent());
		$alert->setSubject($messages->getFrom());
		$alert->setRecipient($recipient);
		$alert->setNotifId($alertTyped->getNotification()->getId());
		$alert->setType(Alert::ALERT_SMS);
		array_push($alertArr, $alert);
	    }
	}
	return $alertArr;
    }

    public function toObject(array $alertArr) : Alert
    {
	$alert = new Alert();
	$alert->setId($alertArr['id']);
	$alert->setRecipient($alertArr['recipient']);
	$alert->setNotifId($alertArr['notif_id']);
	$alert->setCreatedAt($alertArr['created_at']);
	$alert->setstatus($alertArr['status']);
	$alert->setMessage($alertArr['message']);
	$alert->setSubject($alertArr['subject']);
	$alert->setType($alertArr['type']);
    }

    public function toArray(Alert $alert) : array
    {
	return $this->transform($alert);
    }

}
