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

function applicationNew($link, $user, $title, $phone, $description, $file)
{
    $title = trim($title);
    $phone = trim($phone);
    $description = trim($description);
    $image = null;
    if ($file['tmp_name']) {
        $upload_dir     = $_SERVER['DOCUMENT_ROOT'];
        $file_name = '/upload/images/'.time()."_".basename($file['name']);
        $upload_file = $upload_dir.$file_name;
        move_uploaded_file($file['tmp_name'], $upload_file);
        $image = $file_name;
    }

    $query = $link->prepare("INSERT INTO applications (user, title, phone, description, image) VALUES (?, ?, ?, ?, ?)");
    $query->execute(array($user, $title, $phone, $description, $image));

    return $link->lastInsertId();
}

function applicationEdit($link, $id, $user, $title, $phone, $description, $file)
{
    $title = trim($title);
    $phone = trim($phone);
    $description = trim($description);
    $id = (int)$id;

    if ($file['tmp_name']) {
        $query = $link->prepare("SELECT image FROM applications WHERE id=?");
        $query->execute(array($id));
        $application = $query->fetch(PDO::FETCH_ASSOC);
        $old_image = $application['image'];
        $upload_dir     = $_SERVER['DOCUMENT_ROOT'];
        if ($old_image) {
            unlink($upload_dir.$old_image);
        }
        $file_name = '/upload/images/'.time()."_".basename($file['name']);
        $upload_file = $upload_dir.$file_name;
        move_uploaded_file($file['tmp_name'], $upload_file);
        $image = $file_name;
    } else {
        $image = null;
    }

    if ($user == 'admin') {
        if ($image == null) {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=?  WHERE id=?");
            $query->execute(array($title, $phone, $description, $id));
        } else {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=?, image=?  WHERE id=?");
            $query->execute(array($title, $phone, $description, $image, $id));
        }
    } else {
        if ($image == null) {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=? WHERE id=? AND user=?");
            $query->execute(array($title, $phone, $description, $id, $user));
        } else {
            $query = $link->prepare("UPDATE applications SET title=?, phone=?, description=?, image=?  WHERE id=? AND user=?");
            $query->execute(array($title, $phone, $description, $image, $id, $user));
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
        $query = $link->prepare("SELECT image FROM applications WHERE id=?");
        $query->execute(array($id));
        $application = $query->fetch(PDO::FETCH_ASSOC);
        $old_image = $application['image'];
        $upload_dir     = $_SERVER['DOCUMENT_ROOT'];
        if ($old_image) {
            unlink($upload_dir.$old_image);
        }

        $query = $link->prepare("DELETE FROM applications WHERE id=?");
        $query->execute(array($id));
    } else {
        $query = $link->prepare("SELECT image FROM applications WHERE id=? AND user=?");
        $query->execute(array($id, $user));
        $application = $query->fetch(PDO::FETCH_ASSOC);
        $old_image = $application['image'];
        $upload_dir     = $_SERVER['DOCUMENT_ROOT'];
        if ($old_image) {
            unlink($upload_dir.$old_image);
        }
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
        $new_application->addChild('image', $application['image']);
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
