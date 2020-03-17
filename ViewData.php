<?php

/**
 * Copyright 2010-2019 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * This file is licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License. A copy of
 * the License is located at
 *
 * http://aws.amazon.com/apache2.0/
 *
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
*/

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Aws\DynamoDb\Exception\DynamoDbException;


$sdk = new Aws\Sdk([
    'endpoint'   => 'http://localhost:9000',
    'region'   => 'us-west-2',
    'version'  => 'latest'
]);
//print_r($sdk);


$dynamodb = $sdk->createDynamoDb();
print("<pre color='red'>".print_r($dynamodb,true)."</pre>");
//print_r($dynamodb);
//
$scan_response = $dynamodb->scan(array(
    'TableName' => 'Movies' 
));

//print_r($scan_response);

$tableName = 'Movies';
// $params = [
//     'TableName' => $tableName,
//     'ProjectionExpression' => 'year, title, info.genres, info.actors[0]',
   
    
// ];

//var_dump($scan_response);
//print_r($scan_response['@metadata']);  
try {
        echo "<table border='1' cellpadding='2' cellspacing='0'>";
        $i=0;
        foreach ($scan_response['Items'] as $item)
        {
             $i++;
                echo "<tr>";
              echo "<td>".$item['title']['S']."</td>&nbsp;<td>".$item['year']['N']."</td>";
              echo "<tr>";
                if($i==10)
                {
                break;
                }
         }
         echo "</table>";
    } catch (DynamoDbException $e) {
        echo "Unable to add movie:\n";
        echo $e->getMessage() . "\n";
        //break;
    }





?>