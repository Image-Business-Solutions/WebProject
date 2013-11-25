<?php
DEFINE('SALT', '5e53e1c6ebed12c59f09b7ece048ca39e77263b2b6bfa446b1a45c5bb4dbe6c5');
function EncryptPassword($password)
{

	return hash("sha256", SALT.$password);
}