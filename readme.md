Send simple messages to Slack through Webhook API

**Installation:**
1. Create a webhook integration for your Slack here: https://my.slack.com/services/new/incoming-webhook/
2. $$$

```php
$messenger = new \BiteIT\SimpleSlackMessenger('YOUR_WEBHOOK_URL');
$msg = new \BiteIT\SimpleSlackMessage();
$msg->setText('Hello')
    ->setName('MyBotName')
    ->setIconEmoji('hankey');

$messenger->sendSimpleMessage($msg);
```

