<?php

 

$csvFile = "population.csv";

if (!file_exists($csvFile)) {
    echo "ERROR: population.csv not found.\n";
    echo "Download it from: https://datahub.io/core/population/r/population.csv\n";
    exit;
}

// Read CSV
$data = array_map("str_getcsv", file($csvFile));
$header = array_shift($data);

// Extract country + year + population
$popData = [];

foreach ($data as $row) {
    $country = $row[0];
    $year = (int)$row[2];
    $population = (int)$row[3];

    // Take latest year only (2021 / 2020)
    if ($year >= 2020) {
        $popData[$country] = $population;
    }
}

// Sort desc
arsort($popData);

// Display results
echo "=====================================\n";
echo " WORLD POPULATION (CSV OPEN DATA)\n";
echo "=====================================\n";

echo "Countries found: " . count($popData) . "\n\n";

echo "Top 10 Most Populated Countries:\n";
echo "-------------------------------------\n";

$i = 1;
foreach ($popData as $country => $population) {
    echo "$i. $country - " . number_format($population) . "\n";
    if ($i++ == 10) break;
}
