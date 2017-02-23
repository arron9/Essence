<?php
namespace Plu\Admin\Controllers\Home;

use Phalcon\Mvc\Controller as ControllerBase;

/**
 * @RoutePrefix('/signup')
 */
class SignupController extends ControllerBase
{
    /** 
     * @Route('/')
     * 
     */
    public function indexAction() {

    }

	public function registerAction()
	{

		$user = new Users();

		// Store and check for errors
		$success = $user->save(
			$this->request->getPost(),
			array('name', 'email')
		);

		if ($success) {
			echo "Thanks for registering!";
		} else {
			echo "Sorry, the following problems were generated: ";
			foreach ($user->getMessages() as $message) {
				echo $message->getMessage(), "<br/>";
			}
		}

		$this->view->disable();
	}

}
