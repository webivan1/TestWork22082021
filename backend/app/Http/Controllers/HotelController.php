<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\HotelCreateRequest;
use App\Http\Requests\HotelListRequest;
use App\Http\Requests\HotelUpdateRequest;
use App\Models\Hotel\Entity\Hotel;
use App\Models\Hotel\UseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index(HotelListRequest $request, UseCase\Request\Handler $handler): JsonResponse
    {
        $command = new UseCase\Request\Command();
        $command->page = (int) $request->input('page', 1);
        return response()->json($handler->getList($command));
    }

    public function store(HotelCreateRequest $request, UseCase\Mutate\Handler $handler): JsonResponse
    {
        try {
            $command = $this->getCommandByRequest($request);
            $command->image = $request->file('image')->store('images');

            $model = $handler->create($command);

            return response()->json([
                'status' => 'success',
                'model' => $model
            ]);
        } catch (\DomainException $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function show(Hotel $hotel): JsonResponse
    {
        return response()->json($hotel);
    }

    public function update(HotelUpdateRequest $request, Hotel $hotel, UseCase\Mutate\Handler $handler): JsonResponse
    {
        try {
            $command = $this->getCommandByRequest($request);

            if ($request->file('image')) {
                $command->image = $request->file('image')->store('images');
                Storage::delete($hotel->image);
            }

            $handler->update($hotel, $command);

            return response()->json([
                'status' => 'success',
                'model' => $hotel
            ]);
        } catch (\DomainException $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function destroy(Hotel $hotel, UseCase\Mutate\Handler $handler): JsonResponse
    {
        try {
            $image = $hotel->image;
            $handler->remove($hotel);
            empty($image) ?: Storage::delete($image);
            return response()->json(['status' => 'success']);
        } catch (\DomainException $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    private function getCommandByRequest(Request $request): UseCase\Mutate\Command
    {
        $command = new UseCase\Mutate\Command();
        $command->name = $request->input('name');
        $command->city = $request->input('city');
        $command->address = $request->input('address');
        $command->latitude = $request->input('latitude');
        $command->longitude = $request->input('longitude');
        $command->stars = $request->input('stars');
        $command->description = $request->input('description');

        return $command;
    }
}
