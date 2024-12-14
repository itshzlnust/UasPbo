<?php

class Film
{
    private $db = null;
    private $value = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function validate($form)
    {
        $validate = new Validation($form);
        $validate->setRules('judul', 'Judul', ['required' => TRUE]);
        $validate->setRules('tahun', 'Tahun', ['required' => TRUE, 'numeric' => TRUE]);
        $validate->setRules('genre', 'Genre', ['required' => TRUE]);
        $validate->setRules('sutradara', 'Sutradara', ['required' => TRUE]);
        $validate->setRules('durasi', 'Durasi', ['required' => TRUE, 'numeric' => TRUE]);
        $validate->setRules('sinopsis', 'Sinopsis', ['required' => TRUE]);
        $validate->setRules('poster', 'Poster', ['required' => TRUE]);

        if ($validate->passed() === FALSE) {
            return $validate->getErrors();
        }

        return TRUE;
    }

    public function addFilm($data)
    {
        return $this->db->insert('film', $data);
    }

    public function getFilm($id = null)
    {
        if ($id) {
            return $this->db->getWhere('film', 'id', $id);
        }

        return $this->db->get('film');
    }

    public function updateFilm($id, $data)
    {
        $this->db->update('film', $data, "id = $id");
    }

    public function deleteFilm($id)
    {
        $this->db->delete('film', $id);
    }

    public function searchFilm($keyword)
    {
        return $this->db->search('film', 'judul', $keyword);
    }

    public function getErrors()
    {
        return $this->value;
    }
}
