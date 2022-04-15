<?php

namespace App\Listeners\AuditLog;

use App\Events\AuditLog\AuditHandlerEvent;
use App\Repositories\AuditHistory\Interfaces\AuditHistoryInterface;
use Illuminate\Http\Request;

class AuditHandlerListener
{
    /**
     * @var AuditHistoryInterface
     */
    public $auditLogRepository;

    /**
     * @var Request
     */
    protected $request;

    /**
     * AuditHandlerListener constructor.
     *
     * @param AuditHistoryInterface $auditLogRepository
     * @param Request $request
     *
     */
    public function __construct(AuditHistoryInterface $auditLogRepository, Request $request)
    {
        $this->auditLogRepository = $auditLogRepository;
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param AuditHandlerEvent $event
     * @return void
     *
     */
    public function handle(AuditHandlerEvent $event)
    {
        $data = [
            'user_agent'     => $this->request->userAgent(),
            'ip_address'     => $this->request->ip(),
            'module'         => $event->module,
            'action'         => $event->action,
            'user_id'        => $this->request->user() ? $this->request->user()->getKey() : 0,
            'reference_user' => $event->referenceUser,
            'reference_id'   => $event->referenceId,
            'reference_name' => $event->referenceName,
            'type'           => $event->type,
        ];
        if (!in_array($event->action, ['loggedin', 'password'])) {
            $data['request'] = json_encode($this->request->input());
        }

        $this->auditLogRepository->createOrUpdate($data);
    }
}
