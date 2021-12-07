<?php namespace App\Models;

use App\Core\Database;

class ContactModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function handleContact()
    {
        $data = $_POST;

        $this->db->query("INSERT INTO contact_us (subject , comment, email)
            VALUES (:subject, :comment, :email)");

        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':email', $data['email']);

        if ($this->db->execute())
            header('Location:/table');

    }
}
