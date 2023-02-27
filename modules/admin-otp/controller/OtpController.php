<?php
/**
 * OtpController
 * @package admin-otp
 * @version 0.0.1
 */

namespace AdminOtp\Controller;

use LibPagination\Library\Paginator;
use LibFormatter\Library\Formatter;
use LibForm\Library\Form;
use LibOtp\Model\Otp;

class OtpController extends \Admin\Controller
{
    protected function getParams(string $title): array
    {
        return [
            '_meta' => [
                'title' => $title,
                'menus' => ['otp']
            ],
            'subtitle' => $title,
            'pages' => null
        ];
    }

    function indexAction()
    {
        if (!$this->user->isLogin()) {
            return $this->loginFirst(1);
        }
        
        if (!$this->can_i->otp_read) {
            return $this->show404();
        }
        
        $cond = [
            'status' => 1,
            'expires' => ['__op', '>', date('Y-m-d H:i:s')]
        ];
        $pcond = [];
        $params = $this->getParams('Otp');

        if ($q = $this->req->getQuery('q')) {
            $cond['q'] = $pcond['q'] = $q;
        }

        $params['form'] = $form = new Form('admin.otp.index');
        $params['form']->validate( (object)$this->req->get() );

        list($page, $rpp) = $this->req->getPager(12, 25);
        
        $objs = Otp::get($cond, $rpp, $page, ['id'=>false]) ?? [];
        if ($objs) {
            $fmt = [];
            $objs = Formatter::formatMany('otp', $objs, $fmt);
        }
        
        $params['objects'] = $objs;

        // pagination
        $params['total'] = $total = Otp::count($cond);
        if ($total > $rpp){ 
            $params['pages'] = new Paginator(
                $this->router->to('adminOtpIndex'),
                $total,
                $page,
                $rpp,
                10,
                $pcond
            );
        }
        
        $this->resp('otp/index', $params);
    }
}
