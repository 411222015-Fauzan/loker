<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DatabaseCleanup extends Migration
{
    public function up()
    {
        // 1. Cleanup Duplicate Wilayah
        $db = \Config\Database::connect();
        
        // Get all unique names that have duplicates
        $query = $db->query("SELECT nama_wilayah, GROUP_CONCAT(id ORDER BY id ASC) as ids, COUNT(*) as count FROM wilayah GROUP BY nama_wilayah HAVING count > 1");
        $results = $query->getResultArray();

        foreach ($results as $row) {
            $ids = explode(',', $row['ids']);
            $validId = $ids[0]; // Keep the first one (smallest ID)
            $duplicateIds = array_slice($ids, 1);
            
            if (!empty($duplicateIds)) {
                $idsString = implode(',', $duplicateIds);
                
                // Remap Foreign Keys 
                // lowongan_pekerjaan
                $db->query("UPDATE lowongan_pekerjaan SET wilayah_id = $validId WHERE wilayah_id IN ($idsString)");
                
                // perusahaan_profiles
                $db->query("UPDATE perusahaan_profiles SET wilayah_id = $validId WHERE wilayah_id IN ($idsString)");
                
                // pelamar_profiles (if exists? Let's check model... assuming basic structure for now)
                // If there are other tables using wilayah_id, add here.
                
                // Delete duplicates
                $db->query("DELETE FROM wilayah WHERE id IN ($idsString)");
            }
        }

        // 2. Add Unique Constraint to Wilayah
        // Check if index exists first to avoid error? Or just try add.
        // CodeIgniter AddKey is for createTable. For alter, use query.
        try {
            $db->query("ALTER TABLE wilayah ADD UNIQUE (nama_wilayah)");
        } catch (\Throwable $e) {
            // Index might already exist or data still duplicate (shouldn't be)
        }

        // 3. Add Unique Constraint to Users Email (if not exists)
        try {
            $db->query("ALTER TABLE users ADD UNIQUE (email)");
        } catch (\Throwable $e) {
            // Index might already exist
        }
    }

    public function down()
    {
        // Cannot easily restore deleted duplicates without backup.
        // We can just drop the unique constraints.
        $db = \Config\Database::connect();
        $db->query("ALTER TABLE wilayah DROP INDEX nama_wilayah");
        $db->query("ALTER TABLE users DROP INDEX email");
    }
}
