<?php

class Application
{
	public static function getApplicationList()
	{
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM applications ORDER BY id DESC');
		$applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
		return $applicationList;
	}

	public static function getApplicationItemById($id)
	{
		$db = Db::getConnection();
		$result = $db->query('SELECT * FROM applications WHERE id=' . $id);
		$applicationItem = $result->fetch(PDO::FETCH_ASSOC);
		return $applicationItem;
	}

	public static function deleteApplicationItemById($id)
	{
		$db = Db::getConnection();
		$db->query('DELETE FROM applications WHERE id=' . $id );
		$result = $db->query('SELECT * FROM applications ORDER BY id DESC');
		$applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
		return $applicationList;
	}

	public static function updateApplicationItem($id, $title, $phone, $description, $file)
	{
		$db = Db::getConnection();
		if ($file['tmp_name']) {
			$result = $db->query("SELECT image FROM applications WHERE id=".$id);
			$applicationItem = $result->fetch(PDO::FETCH_ASSOC);
			$oldFile = $applicationItem['image'];
			if ($oldFile) unlink(ROOT . $oldFile);
			$image = '/template/images/'.time()."_".basename($file['name']);
			$newFile = ROOT.$image;
			move_uploaded_file($file['tmp_name'], $newFile);
		} else {
			$image = null;
		}
		$db->query("UPDATE `applications` SET `title`=\"" . $title . "\",`phone`=\"".$phone . "\",`description`=\"".$description."\",`image`=\"".$image."\" WHERE id=" . $id);
		$result = $db->query("SELECT * FROM applications ORDER BY id DESC");
		$applicationList = $result->fetchAll(PDO::FETCH_ASSOC);
		return $applicationList;
	}

	public static function newApplicationItem()
	{
		$db = Db::getConnection();
		$result = $db->query('INSERT INTO `applications`(`user`, `title`, `phone`, `description`, `image`) VALUES ("admin","","","","")');
		$id = $db->lastInsertId();
		$result = $db->query('SELECT * FROM applications WHERE id=' . $id);
		$applicationItem = $result->fetch(PDO::FETCH_ASSOC);
		return $applicationItem;
	}
}