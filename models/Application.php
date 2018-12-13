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
		$result = $db->query('SELECT * FROM applications WHERE user="'.$_SESSION['user'].'" ORDER BY id');
		$applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
		return $applicationList;
	}

	public static function getApplicationItem($id)
	{
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM applications WHERE id=' . $id);
		$applicationItem = $result->fetch(PDO::FETCH_ASSOC);
		return $applicationItem;
	}

	public static function deleteApplicationItem($id)
	{
		echo deleteApplicationItem;
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM applications WHERE id=' . $id);
		$applicationItem = $result->fetch(PDO::FETCH_ASSOC);
		if ($applicationItem['image']) unlink(ROOT . $applicationItem['image']);
		$db->query('DELETE FROM applications WHERE id=' . $id);
		$result = $db->query('SELECT * FROM applications ORDER BY id ASc');
		$applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
		return $applicationList;
	}

	public static function updateApplicationItem($id, $title, $phone, $description, $file)
	{
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM applications WHERE id="' . $id . '"');
		$applicationListItem = $result->fetch(PDO::FETCH_ASSOC);
		if ($file['tmp_name']) {
			if ($applicationItem['image']) unlink(ROOT . $applicationItem['image']);
			$image = '/template/images/'.time()."_".basename($file['name']);
			$newFile = ROOT . $image;
			move_uploaded_file($file['tmp_name'], $newFile);
			$db->query('UPDATE applications SET title="'.$title.'", phone="'.$phone.'", description="'.$description.'", image="'.$image.'" WHERE id="'.$id.'"');
		} else {
			$db->query('UPDATE applications SET title="'.$title.'", phone="'.$phone.'", description="'.$description.'" WHERE id="'.$id.'"');
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
		$db->query('INSERT INTO `applications`(`user`, `title`, `phone`, `description`, `image`) VALUES ("' . $_SESSION['user'] . '","' . $title . '","' . $phone . '","' . $description . '","' . $image . '")');
		$id = $db->lastInsertId();
		return $id;
	}

	public static function isApplicationItemOfUser($id, $user)
	{
		if ($user == 'admin')
			return true;
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM applications WHERE id=' . $id);
		$applicationItem = $result->fetch(PDO::FETCH_ASSOC);
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