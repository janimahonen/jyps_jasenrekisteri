<?php

namespace JYPS\RegisterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Endroid\QrCode\QrCode;

class MemberControllerTest extends WebTestCase
{
	public function testSimpleJoin() {
 		$client = static::createClient();

        $crawler = $client->request('GET', '/join');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Henkilötiedot")')->count()
        );	

        $buttonCrawlerNode = $crawler->selectButton('memberid_save');
        $form = $buttonCrawlerNode->form();

        $form = $buttonCrawlerNode->form(array(
    	'memberid[firstname]' => 'Teuvo',
    	'memberid[surname]'   => 'Testaaja',
		));
        $client->submit($form);
        
        $this->assertGreaterThan(
            0,
        	$crawler->filter('html:contains("virhetilanteeseen")')->count()
        );	
    }
}
