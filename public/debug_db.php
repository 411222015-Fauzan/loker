<?php
$mysqli = new mysqli("localhost", "root", "", "job_portal_ci4");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "\n=== ALL Company Profiles ===\n";
$res = $mysqli->query("SELECT id, nama_perusahaan, user_id FROM perusahaan_profiles");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== Lamaran Pekerjaan Schema ===\n";
$res = $mysqli->query("DESCRIBE lamaran_pekerjaan");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== Wilayah (Jakarta Selatan) ===\n";
$res = $mysqli->query("SELECT * FROM wilayah WHERE nama_wilayah LIKE '%Jakarta Selatan%'");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== Duplicate Users (by email) ===\n";
$res = $mysqli->query("SELECT email, COUNT(*) as count FROM users GROUP BY email HAVING count > 1");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== Duplicate Wilayah (by name) ===\n";
$res = $mysqli->query("SELECT nama_wilayah, COUNT(*) as count, GROUP_CONCAT(id) as ids FROM wilayah GROUP BY nama_wilayah HAVING count > 1");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== Klasifikasi Table ===\n";
$res = $mysqli->query("SELECT * FROM klasifikasi_pekerjaan LIMIT 20");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== ALL Current Jobs ===\n";
$res = $mysqli->query("SELECT id, judul, status_pekerjaan FROM lowongan_pekerjaan");
while($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n=== Search Test: 'Accounting' ===\n";
$res = $mysqli->query("SELECT id, judul FROM lowongan_pekerjaan WHERE judul LIKE '%Accounting%' OR status_pekerjaan = 'open'"); 
// Wait, the logic in Model is OR LIKE company. 
// Let's replicate Model logic roughly:
$keyword = 'Accounting';
$sql = "SELECT id, judul FROM lowongan_pekerjaan WHERE (judul LIKE '%$keyword%') AND status_pekerjaan = 'open'";
$res = $mysqli->query($sql);
if ($res->num_rows == 0) echo "No results for '$keyword'\n";
while($row = $res->fetch_assoc()) print_r($row);

echo "\n=== Search Test: 'Akuntansi' ===\n";
$keyword = 'Akuntansi';
$sql = "SELECT id, judul FROM lowongan_pekerjaan WHERE (judul LIKE '%$keyword%') AND status_pekerjaan = 'open'";
$res = $mysqli->query($sql);
if ($res->num_rows == 0) echo "No results for '$keyword'\n";
while($row = $res->fetch_assoc()) print_r($row);

echo "\n=== All Jakarta Selatan IDs ===\n";
$res = $mysqli->query("SELECT id, nama_wilayah FROM wilayah WHERE nama_wilayah LIKE '%Jakarta Selatan%'");
while($row = $res->fetch_assoc()) {
    echo "ID: " . $row['id'] . " - " . $row['nama_wilayah'] . "\n";
}
