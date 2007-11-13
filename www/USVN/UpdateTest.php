<?php
/**
 * Check for update
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.7
 * @package usvn
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id$
 */
// Call USVN_TranslationTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_UpdateTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Translation.
 * Generated by PHPUnit_Util_Skeleton on 2007-03-10 at 16:05:57.
 */
class USVN_UpdateTest extends USVN_Test_Test {
	/**
    * Runs the test methods of this class.
    *
    * @access public
    * @static
    */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_UpdateTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }
    
    public function test_itsCheckForUpdateTime()
    {
    	$config = Zend_Registry::get('config');
    	
    	$this->assertTrue(USVN_Update::itsCheckForUpdateTime());
    	$config->update = array("lastcheckforupdate" => 10);
    	$this->assertTrue(USVN_Update::itsCheckForUpdateTime());
    	$config->update = array("lastcheckforupdate" => time() - 10);	
    	$this->assertFalse(USVN_Update::itsCheckForUpdateTime());
    }
    
    public function test_getUSVNAvailableVersion()
    {
    	$config = Zend_Registry::get('config');
    	$this->assertEquals($config->version, USVN_Update::getUSVNAvailableVersion());
    	file_put_contents($config->subversion->path . DIRECTORY_SEPARATOR . ".usvn-version", "0.8.4");
    	$this->assertEquals("0.8.4", USVN_Update::getUSVNAvailableVersion());
    }
}

// Call USVN_UpdateTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_UpdateTest::main") {
    USVN_UpdateTest::main();
}
