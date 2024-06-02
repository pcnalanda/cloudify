<?php

$brokers = 'kafka:9092'; // Kafka broker address
$topicName = 'test_topic'; // Kafka topic to produce to

$conf = new RdKafka\Conf();
$conf->set('metadata.broker.list', $brokers);

// Create producer instance
$producer = new RdKafka\Producer($conf);
$producer->addBrokers($brokers);

// Create a Kafka topic instance
$topic = $producer->newTopic($topicName);

// Produce multiple messages
for ($i = 0; $i < 5; $i++) {
    $message = "Message $i";
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
    echo "Produced: $message\n";
    
}

// Wait for all messages to be sent
while ($producer->getOutQLen() > 0) {
    $producer->poll(50);
}

?>
