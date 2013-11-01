<?php
class TestFestsController extends AppController {

	public function index() {
		return $this->redirect(array('action' => 'add'));
	}
	
	public function add() {
		if ($this->request->is('post')) {
			if ($this->TestFest->validates()) {
				if($this->TestFest->addData($this->request->data)){
					$this->Session->setFlash(__('The data has been saved.'));
					return $this->redirect(array('action' => 'add'));
				}
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		}
	}
}