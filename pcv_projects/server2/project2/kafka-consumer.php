<?php

$brokers = 'kafka:9092'; // Kafka broker address
$topicName = 'test_topic'; // Kafka topic to consume from

$conf = new RdKafka\Conf();
$conf->set('metadata.broker.list', $brokers);

// Create consumer instance
$consumer = new RdKafka\Consumer($conf);
$consumer->addBrokers($brokers);


// Create a Kafka topic instance
$topic = $consumer->newTopic($topicName);

// Start consuming messages from the beginning
$topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);

echo "Consumer started. Listening to topic: $topicName\n";

while(true) {
    $message = $topic->consume(0, 1000); // Wait for 1 second for a message

    if ($message === null) {
        echo "No message received (null returned).\n";
        continue;
    }

    if ($message->err) {
        switch ($message->err) {
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                echo 'Message received with No error: ' . $message->payload . '<br />'. PHP_EOL;
                break;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                echo 'End of partition reached, no more messages. Will continue listening...' . PHP_EOL;
                break;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                echo 'Consume timed out, no messages currently available.' . PHP_EOL;
                break;
            default:
                echo 'Error: ' . $message->errstr() . PHP_EOL;
                break;
        }
    } else {
        echo 'Message received: ' . $message->payload . '<br />'. PHP_EOL;
    }
}

?>
