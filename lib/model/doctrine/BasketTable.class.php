<?php


class BasketTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Basket');
    }
    
   public function isBasketSelectionDuplicate($id_artwork,$id_customer,$basket_status)
    {
        return  $this->createQuery('b')
 		 ->select('b.idbasket')
  		->where('b.fkidartworksfrombasket = ?', $id_artwork)
  		->andWhere('b.fkidcustomersfrombasket = ?', $id_customer)
  		->andWhere('b.fkidbasket_status = ?', $basket_status)
  		->count();  		
  
    }
    
public function deleteFromSelection($id_artwork,$id_customer,$basket_status)
    {
        return  $this->createQuery('b')
 		->delete()
  		->where('b.fkidartworksfrombasket = ?', $id_artwork)
  		->andWhere('b.fkidcustomersfrombasket = ?', $id_customer)
  		->andWhere('b.fkidbasket_status = ?', $basket_status)
  		->execute();  		
  
    }
    
public function addToSelection($id_artwork,$id_customer,$basket_status)
    {
        return  $this->createQuery('b')
 		 ->select('b.idbasket')
  		->where('b.fkidartworksfrombasket = ?', $id_artwork)
  		->andWhere('b.fkidcustomersfrombasket = ?', $id_customer)
  		->andWhere('b.fkidbasket_status = ?', $basket_status)
  		->count();  		
  
    }
    
}