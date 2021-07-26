<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\HotelFormRequest;
use App\Http\Requests\HotelListRequest;
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

    public function store(HotelFormRequest $request, UseCase\Mutate\Handler $handler): JsonResponse
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

    public function update(HotelFormRequest $request, Hotel $hotel, UseCase\Mutate\Handler $handler): JsonResponse
    {
        try {
            $command = $this->getCommandByRequest($request);

            if ($request->file('image')) {
                $command->image = $request->file('image')->store('images');
                Storage::delete($hotel->image);
            }

            $newHotel = $handler->update($hotel->id, $command);

            return response()->json([
                'status' => 'success',
                'model' => $newHotel
            ]);
        } catch (\DomainException $e) {
            return $this->jsonErrorResponse($e->getMessage());
        }
    }

    public function destroy(Hotel $hotel, UseCase\Mutate\Handler $handler): JsonResponse
    {
        try {
            $image = $hotel->image;
            $handler->remove($hotel->id);
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
        $command->description = $request->input('description');

        if ($lat = $request->input('latitude')) {
            $command->latitude = (float)$lat;
        }

        if ($lon = $request->input('longitude')) {
            $command->longitude = (float)$lon;
        }

        if ($stars = $request->input('stars')) {
            $command->stars = (int)$stars;
        }

        return $command;
    }
}
