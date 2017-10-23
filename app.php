<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
# [START example]
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
// create the Silex application
$app = new Application();
// Create the PDO object for CloudSQL Postgres.
$dsn = getenv('POSTGRES_DSN');
$user = getenv('POSTGRES_USER');
$password = getenv('POSTGRES_PASSWORD');
$pdo = new PDO($dsn, $user, $password);

// Create the database if it doesn't exist
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query('CREATE TABLE IF NOT EXISTS btctrades ' .
    '(tid interger NOT NULL,amount double precision NOT NULL,price money NOT NULL,timestamp interger NOT NULL,PRIMARY KEY (tid))');
	
// Add the PDO object to our Silex application.
$app['pdo'] = $pdo;
$app->get('/', function (Application $app) {

	$json = file_get_contents('https://api.btcmarkets.net/market/BTC/AUD/trades');
	$obj = json_decode($json);
	
	foreach($obj as $data){
		$pdo = $app['pdo'];
    $insert = $pdo->prepare('INSERT INTO btctrades (tid,amount,price,timestamp) values (:tid,:amount,:price,:timestamp)');
    $insert->execute(['tid' => $data->tid,'amount' => $data->amount,'price' => $data->price,'timestamp' => $data->date]);
	}

});
# [END example]
return $app;
?>
