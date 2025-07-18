<?php
$pageTitleForHead = "Интерактивная карта";
$pageSpecificTitleH2 = "Все дома и бизнесы";
require_once 'config/config.php';
$map_items_data_for_js_array = [];
$conn = new mysqli("localhost", "root", "root", "mainconfig");
if ($conn->connect_error) die("DB Connection Error");

$result = $conn->query("SELECT id, owner, type, position, price, locked FROM houses");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $p = json_decode($row['position'], true);
        if (isset($p['x']) && isset($p['y'])) {
            $map_items_data_for_js_array[] = [
                'map_item_type' => 'house',
                'id' => (int)$row['id'],
                'owner' => trim($row['owner']) ?: 'Свободен',
                'type_name' => 'Дом',
                'game_x' => (float)$p['x'],
                'game_y' => (float)$p['y'],
                'game_z' => isset($p['z']) ? (float)$p['z'] : null,
                'price' => (int)$row['price'],
                'is_locked' => (bool)$row['locked']
            ];
        }
    }
}
$json_map_items_data_for_js = json_encode($map_items_data_for_js_array);
?><!DOCTYPE html><html><head><meta charset="utf-8"><title>Интерактивная карта</title></head><body>
<div id="map" style="width:100%;height:800px;border:1px solid #ccc;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=ВАШ_API_КЛЮЧ&callback=initMap" async defer></script>
<script>
const locations = <?php echo $json_map_items_data_for_js; ?>;
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 2, center: {lat: 0, lng: 0}, mapTypeId: 'roadmap'
    });
    locations.forEach(item => {
        const marker = new google.maps.Marker({
            position: {lat: 0 - item.game_y / 70000, lng: item.game_x / 70000},
            map: map, title: item.type_name + ' #' + item.id
        });
    });
}
</script></body></html>