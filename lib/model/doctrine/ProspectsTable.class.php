<?php


class ProspectsTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Prospects');
    }
    
    /**
	 * Migrate the prospects to the customers table.
	 *
	 * @param int $id_prospect  prospect id
	 * @return boolean
	 */
	public function migrateProspectsToCustomers($id_prospect)
	{
	    $manager = Doctrine_Manager::getInstance();
		$conn = $manager->getConnection('doctrine');					
		$stmt = $conn->prepare('call migrate_prospects_to_customers(?)');		
		$stmt->execute(array($id_prospect));
		$results = $stmt->fetch();
		
		sfContext::getInstance()->getLogger()->log($stmt->getQuery());				
		
		return $results['@insertedId'] ;
	}
    
}