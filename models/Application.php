<?php

class Application
{
    public static function getApplicationList()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT * FROM applications ORDER BY id');
        $applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
        return $applicationList;
    }

    public static function getUsersApplicationList()
    {
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT * FROM applications WHERE user=? ORDER BY id');
        $statement->execute(array($_SESSION['user']));
        $applicationList = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $applicationList;
    }

    public static function getApplicationItem($id)
    {
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT * FROM applications WHERE id=?');
        $statement->execute(array(intval($id)));
        $applicationItem = $statement->fetch(PDO::FETCH_ASSOC);
        return $applicationItem;
    }

    public static function deleteApplicationItem($id)
    {
        echo deleteApplicationItem;
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT image FROM applications WHERE id=?');
        $statement->execute(array((int)$id));
        $applicationItem = $statement->fetch(PDO::FETCH_ASSOC);
        if ($applicationItem['image']) unlink(ROOT . $applicationItem['image']);
        $statement = $db->prepare('DELETE FROM applications WHERE id=?');
        $statement->execute(array((int)$id));
        $result = $db->query('SELECT * FROM applications ORDER BY id');
        $applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
        return $applicationList;
    }

    public static function updateApplicationItem($id, $title, $phone, $description, $file)
    {
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT image FROM applications WHERE id=?');
        $statement->execute(array(intval($id)));
        $applicationListItem = $statement->fetch(PDO::FETCH_ASSOC);
        if ($file['tmp_name']) {
            if ($applicationItem['image']) unlink(ROOT . $applicationItem['image']);
            $image = '/template/images/'.time()."_".basename($file['name']);
            $newFile = ROOT . $image;
            move_uploaded_file($file['tmp_name'], $newFile);
            $statement = $db->prepare('UPDATE applications SET title=?, phone=?, description=?, image=? WHERE id=?');
            $statement->execute(array($title, $phone, $description, $image, intval($id)));
        } else {
            $statement = $db->prepare('UPDATE applications SET title=?, phone=?, description=? WHERE id=?');
            $statement->execute(array($title, $phone, $description, $id));
        }
        return true;
    }

    public static function addApplicationItem($title, $phone, $description, $file)
    {
        $db = Db::getConnection();
        if ($file['tmp_name']) {
            $image = '/template/images/'.time()."_".basename($file['name']);
            $newFile = ROOT . $image;
            move_uploaded_file($file['tmp_name'], $newFile);
        } else {
            $image = null;
        }
        $statement = $db->prepare('INSERT INTO applications (user, title, phone, description, image) VALUES (?,?,?,?,?)');
        $statement->execute(array($_SESSION['user'],$title, $phone, $description, $image));
        $id = $db->lastInsertId();
        return $id;
    }

    public static function isUsersApplicationItem($id, $user)
    {
        if ($user == 'admin')
            return true;
        $db = Db::getConnection();
        $statement = $db->prepare('SELECT * FROM applications WHERE id=?');
        $statement->execute(array(intval($id)));
        $applicationItem = $statement->fetch(PDO::FETCH_ASSOC);
        return ($applicationItem['user'] == $user);
    }

    public static function getApplicationListAsXML()
    {
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM applications ORDER by id");
        $applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
        $xmlText = <<<XML
<?xml version='1.0' ?>
<applications>
</applications>
XML;
        $xmlElement = new SimpleXMLElement($xmlText);
        foreach ($applicationList as $applicationItem) {
            $newApplicationItem = $xmlElement->addChild('application');
            $newApplicationItem->addChild('id', $applicationItem['id']);
            $newApplicationItem->addChild('title', $applicationItem['title']);
            $newApplicationItem->addChild('phone', $applicationItem['phone']);
            $newApplicationItem->addChild('description', $applicationItem['description']);
            if ($applicationItem['image'] != null) {
                $newImageItem = $newApplicationItem->addChild('image');
                $image = $newImageItem->addChild('img');
                $image->addAttribute('src', "http://".$_SERVER['SERVER_NAME'].$applicationItem['image']);
            }
        }
        return $xmlElement;
    }
}