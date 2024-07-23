<?php

namespace Modules\Auth\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\Dashboard\Notification\AddNotificationRequest;
use Modules\Auth\Http\Resources\GetAllNotificationCollection;
use Modules\Auth\Services\NotificationService;

class NotificationController extends Controller
{
    public function __construct(protected NotificationService $service) {}

    public function getAll(Request $request)
    {

        $data = $this->service->getAll(true, $request->per_page ?? 8);
        $resource = new GetAllNotificationCollection($data);

        return response()->json($resource);
    }

    public function create(AddNotificationRequest $request)
    {

        $data = $this->service->create($request->validated());

        return response()->json($data);
    }
}
