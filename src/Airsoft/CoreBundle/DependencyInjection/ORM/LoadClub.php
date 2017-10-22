<?php
namespace Airsoft\GestionBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Airsoft\GestionBundle\Entity\Club;

class LoadClub implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
//		$names = array(
//			'Club Airsoft',
//			'11 Avenue de la République',
//			'Narbonne',
//			'11100',
//			'club@gmail.com',
//			'0468435241'
//
//		);
//
//		foreach($names as $name)
//		{
//			$club= new Club();
//			$club->setNomClub($name);
//			$manager->persist($club);
//		}
//		$manager->flush();
		$club = new Club();
		$club->setNomClub('Club FFAirsoft');
		$club->setAdresseClub('Place de la République');
		$club->setVilleClub('Ferrals les Corbières');
		$club->setCpClub('11200');
		$club->setEmailClub('club@gmail.com');
		$club->setTelClub('0468434124');
		$club->setPublished('1');
		$manager->persist($club);
		$manager->flush();
	}
}




?>