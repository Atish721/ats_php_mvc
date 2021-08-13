<?php

class profileModel extends database
{

    public function addFruit($fruit)
    {

        if ($this->insert("fruit", $fruit)) {
            return true;
        }
    }

    public function getData($userId)
    {

        if (is_array($userId)) {

            return $this->fetchAll("fruit", $userId);

        }

    }

    public function edit_data($id, $userId)
    {

        if (!empty($id) && !empty($userId)) {

            $row = $this->fetch('*', 'fruit', ['id' => $id, 'userId' => $userId]);
            return $row;

        }

    }

    public function updateFruit($updateData, $whereClause)
    {

        if (is_array($updateData)) {

            return $this->update("fruit", $updateData, $whereClause);

        }

    }

    public function deleteFruit($id, $userId)
    {

        if ($this->delete("fruit", ['id' => $id, 'userId' => $userId])) {
            return true;
        }

    }

}
