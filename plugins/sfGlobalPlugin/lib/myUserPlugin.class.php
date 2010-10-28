<?php

class myUserPlugin extends sfBasicSecurityUser
{
	public function getUserId(){
	  return  $this->getAttribute('user_id',null,'UserSecurity');	
	}
	
	public function setUserId($id){
		$this->setAttribute('user_id',$id);
	}	
	

	

}