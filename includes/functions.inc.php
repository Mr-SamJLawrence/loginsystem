<?php

function emptyInputSignup($name, $email, $username, $password, $pwdRepeat) {
    $result;
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($pwdRepeat)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
}

function pwdMatch($password, $pwdRepeat) {
    $result;
    if ($password !== $pwdRepeat) {
      $result = true;
    }
    else {
      $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location:../signup.php?error=stmtfaileduidexists");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email); //apparently means two strings
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
      return $row;
    } else {
      $result = false;
      return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location:../signup.php?error=stmtfailedcreateuser");
      exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd); //apparently means four strings
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location:../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
      $result = true;
    } else {
      $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username); //Checks both username and acc email in db

  if ($uidExists === false) {
    header("location:../login.php?error=wronglogina");
    exit();
  }

  $checkPwd = password_hash($pwd, PASSWORD_DEFAULT);
  $matches = $checkPwd === $uidExists["usersPwd"] ? "true" : "false";

  //$checkPwd = password_verify($pwd, $uidExists["usersPwd"]);

  //if ($checkPwd === false) {
  if ($checkPwd !== $uidExists["usersPwd"]) {
    header("location:../login.php?error=wrongloginb" . $matches);
    exit();
  } else {
    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
    header("location:../index.php");
    exit();
  }
}