# Notification common

This is the Notification Common elements package which contains:
                                       
* Notification Entity and transformer
* Notification Entity validator
* Related classes

# Installation and Requirement
  
Notification Common needs PHP 7 or higher.

Add this requirement to your `composer.json: "fei/notification-common": : "^1.0"`

Or execute `composer.phar require fei/notification-common` in your terminal.

# Usage

## Entities and classes

### Notification entity

In addition to traditional id and createdAt fields, Notification entity has **nine** important properties:

| Properties    | Type              | Required | Default value |
|---------------|-------------------|----------|---------------|
| id            | `integer`         | No       |               |
| createdAt     | `datetime`        | No       | Now()         |
| origin        | `string`          | Yes      |               |
| recipient     | `string`          | Yes      |               |
| event         | `string`          | Yes      |               |
| message       | `string`          | Yes      |               |
| type          | `integer`         | No       | 1             |
| status        | `integer`         | No       | 0             |
| parentNotificationId| `integer`   | No       | 0             |
| context       | `json`            | No       |               |
| action        | `json`            | No       |               |


* `origin`is a string representing the origin of the notification 
* `recipient`is a string representing the recipient of the notification
* `event`is a string representing the event linked to the notification
* `message`is a string indicating the message 
* `type` is an integer representing the type of the notification. 1 : Info, 2 : Warning
* `status` is an integer representing the status of the notification. 0 : Unread, 1 : Read, 2 : Acknowledged
* `parentNotificationId` is an integer representing the parent notification
* `context` is a json
* `action` is a json


### Android alert entity

| Properties    | Type              | Required |
|---------------|-------------------|----------|
| notification       | `Notification`         | Yes      | 
| message       | `Message`         | Yes      |                             

* `message`is a Message (described below) indicating the message 

### Message (Android alert)

| Properties    | Type              |
|---------------|-------------------|
| recipients     | `array`          |       
| collapseKey     | `string`           |
| priority     | `string`           |
| timeToLive     | `integer`           |
| restrictedPackageName     | `string`           |
| dryRun     | `boolean`           |
| pushNotification     | `PushNotification`        |


### Email alert entity

| Properties    | Type              | Required |
|---------------|-------------------|----------|
| notification       | `Notification`         | Yes      | 
| email         | `string`          | Yes      |               
| subject       | `string`          | Yes      | 
| content       | `string`          | Yes      |               


* `email`is a string representing the email recipient
* `subject`is a string indicating the subject of the email
* `content`is a string representing the content of the email


### SMS alert entity

| Properties    | Type              | Required |
|---------------|-------------------|----------|
| notification       | `Notification`         | Yes      | 
| message       | `Message`           | Yes      |                             

* `message`is a Message (described below) indicating the message 

### Message (SMS alert)

| Properties    | Type              |
|---------------|-------------------|
| from          | `string`          | 
| recipients    | `array`           | 
| content       | `string`          |


## Other tools

### Notification hydrator and validator

You have the possibility to validate a `Notification` entity with NotificationValidator class:

```php
<?php

use Fei\Service\Notification\Validator;
use Fei\Service\Notification\Entity;

$notificationData = [
  'origin' => 'origin',
  'recipient' => 'thomas',
  'event' => 'chat.message.new',
  'message' => 'Example message',
  'type' => 1,
];

$notification = new Notification();
$notificationValidator = new NotificationValidator();
$notificationHydrator  = new NotificationHydrator();

$notification = $notificationHydrator->hydrate($notificationData, $notification);

//validate returns true if your Notification instance is valid, or false in the other case
$isValid = $notificationValidator->validate($notification);

//getErrors() allows you to get an array of errors if there are some, or an empty array in the other case
$errors = $notificationValidator->getErrors();

```

### Notification and alert creation

```php
<?php

use Fei\Service\Notification\Entity\Alert\Email;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Entity\Alert\Android\Message as AndroidMessage;
use Fei\Service\Notification\Entity\Alert\Sms\Message as SmsMessage;

$notification = (new Notification())
        ->setMessage('Last test')
        ->setOrigin('test')
        ->setEvent('My best event')
        ->setType(Notification::TYPE_INFO)
        ->setAction(json_encode(['my.action' => 'first create']))
        ->setRecipient('user');

$alert_email = (new Email())
        ->setNotification($notification)
        ->setSubject('Email Subject')
        ->setContent('Email content')
        ->setEmail('email@provider.com');

$alert_android = (new Android())
        ->setNotification($notification)
        ->setMessage(new AndroidMessage())
          ->setRecipients(['id_device_1', 'id_device_2'])
          ->setDryRun(true)
          ->setPushNotification(['title' => 'Notif', 'body' => 'Test message']);

       
 $alert_sms = (new Sms())
        ->setNotification($notification)
        ->setMessage(new SmsMessage())
          ->setFrom('email@provider.com')
          ->setRecipients(['email@provider.com', 'email2@provider.com'])
          ->setContent("Sms de test");
```

