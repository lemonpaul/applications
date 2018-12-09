<?php

function applicationsAll($link, $user)
{
    if ($user == 'admin') {
        $query = $link->prepare("SELECT * FROM applications ORDER by id DESC");
        $query->execute();
    } else {
        $query = $link->prepare("SELECT * FROM applications WHERE user=? ORDER by id DESC");
        $query->execute(array($user));
    }

    $applications = $query->fetchAll(PDO::FETCH_ASSOC);

    return $applications;
}

function applicationGet($link, $id_application, $user)
{
    if ($user == 'admin') {
        $query = $link->prepare("SELECT * FROM applications WHERE id=?");
        $query->execute(array((int)$id_application));
    } else {
        $query = $link->prepare("SELECT * FROM applications WHERE id=? AND user=?");
        $query->execute(array((int)$id_application, $user));
    }

    $application = $query->fetch(PDO::FETCH_ASSOC);

    return $application;
}

function applicationNew($link, $user, $title, $phone, $description, $image)
{
    $title = trim($title);
    $phone = trim($phone);
    $description = trim($description);
    $image_type=($image) ? $image['type'] : null;
    $image=($image) ? file_get_contents($image['tmp_name']) : null;

    if ($title == '')
        return false;

    $query = $link->prepare("INSERT INTO applications (user, title, phone, description, image, image_type) VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute(array($user, $title, $phone, $description, $image, $image_type));

    return $link->lastInsertId();
}

function applicationEdit($link, $id, $user, $title, $phone, $description, $image)
{
    $title = trim($title);
    $phone = trim($phone);
    $description = trim($description);
    $id = (int)$id;
    $image_type=($image) ? $image['type'] : null;
    $image=($image) ? file_get_contents($image['tmp_name']) : null;

    if ($title == '')
        return false;

    if ($user == 'admin') {
        if ($image == null) {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=?  WHERE id=?");
            $query->execute(array($title, $phone, $description, $id));
        } else {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=?, image=?, image_type=?  WHERE id=?");
            $query->execute(array($title, $phone, $description, $image, $image_type, $id));
        }
    } else {
        if ($image == null) {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=? WHERE id=? AND user=?");
            $query->execute(array($title, $phone, $description, $id, $user));
        } else {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=?, image=?, image_type=?  WHERE id=? AND user=?");
            $query->execute(array($title, $phone, $description, $image, $image_type, $id, $user));
        }
    }

    return $query->rowCount();
}

function applicationDelete($link, $id, $user)
{
    $id = (int)$id;

    if ($id == 0)
        return false;

    if ($user == 'admin') {
        $query = $link->prepare("DELETE FROM applications WHERE id=?");
        $query->execute(array($id));
    } else {
        $query = $link->prepare("DELETE FROM applications WHERE id=? AND user=?");
        $query->execute(array($id, $user));
    }

    return $query->rowCount();
}

function applicationIntro($text, $len = 500)
{
    return mb_substr($text, 0, $len);
}

function applicationsXml($link)
{
    $query = $link->prepare("SELECT * FROM applications ORDER by id DESC");
    $query->execute();
    $applications = $query->fetchAll(PDO::FETCH_ASSOC);

    $xmlstr = "<?xml version='1.0' ?>\n";
    $xmlstr .= "<applications>\n";
    $xmlstr .= "</applications>";

    $xml = new SimpleXMLElement($xmlstr);

    foreach ($applications as $application) {
        $new_application = $xml->addChild('application');
        $new_application->addChild('id', $application['id']);
        $new_application->addChild('title', $application['title']);
        $new_application->addChild('phone', $application['phone']);
        $new_application->addChild('description', $application['description']);
        $new_application->addChild('image_type', $application['image_type']);
    }
    return $xml->asXML();
}

function checkPhone($phone)
{
    if (preg_match('/^\+?\d{10,12}$/', $phone))
        return true;
    else
        return false;
}

function checkDescription($description)
{
    if (preg_match('/^.{10,}$/', $description))
        return true;
    else
        return false;
}

?>
