<?php

$brokers = 'kafka:9092'; // Kafka broker address
$topicName = 'user-registrations'; // Kafka topic to produce to

$conf = new RdKafka\Conf();
$conf->set('metadata.broker.list', $brokers);

// Create producer instance
$producer = new RdKafka\Producer($conf);
$producer->addBrokers($brokers);

// Create a Kafka topic instance
$topic = $producer->newTopic($topicName);

for ($i = 0; $i < 10; $i++) {
    $message = json_encode(["user_id" => $i, "name" => "User $i", "email" => "pcverma$i@example.com"]);
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
    $producer->poll(0);
    echo "Produced: $message\n";
}

// Wait for messages to be sent
while ($producer->getOutQLen() > 0) {
    $producer->poll(50);
}
?>
