<?php
namespace App\Controller\Api;

use App\Controller\ProfilesController as BaseController;
use App\Traits\ApiFormatsTrait;
use Cake\Event\Event;

/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 *
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfilesController extends BaseController
{

    use ApiFormatsTrait;

    public function beforeRender(Event $event)
    {
        // set data format
        $this->setFormat($this->request->getQuery('format'), function($x) {
            $this->viewBuilder()->setClassName($x);
        });
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $profiles = $this->paginate($this->Profiles);

        $this->set([
            'profiles' => $profiles,
            '_serialize' => ['profiles']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => []
        ]);

        $this->set([
            'profile' => $profile,
            '_serialize' => ['profile']
        ]);
    }
}
