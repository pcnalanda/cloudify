<?php

$conf = new RdKafka\Conf();
$conf->set('group.id', 'email-group');  // Unique group ID
$conf->set('auto.offset.reset', 'earliest');  // Read from the beginning if no offset is stored
$conf->set('metadata.broker.list', 'kafka:9092');

$consumer = new RdKafka\KafkaConsumer($conf);
$consumer->subscribe(['user-registrations']);

echo "Waiting for messages to send welcome emails...\n";

while (true) {
    $message = $consumer->consume(120*1000);
    if ($message === null) {
        echo "No message received (null returned).\n";
        continue;
    }
    if ($message->err) {
        switch ($message->err) {
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                $userData = json_decode($message->payload, true);
                // Code to send a welcome email
                echo "Sent welcome email to: " . $userData['email'] . "\n";
                break;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                echo "No more messages; will wait for more\n";
                break;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                echo "Timed out\n";
                break;
            default:
                throw new \Exception($message->errstr(), $message->err);
                break;
        }
    } else {
        echo 'Message received: ' . $message->payload . ''. PHP_EOL;
    }
}
?>
