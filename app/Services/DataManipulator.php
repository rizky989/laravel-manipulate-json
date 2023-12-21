<?php

namespace App\Services;

/**
 * Class DataManipulator
 *
 * Service for manipulating JSON data.
 */
class DataManipulator
{
    /**
     * @var array $data1 The first set of JSON data.
     */
    private $data1;

    /**
     * @var array $data2 The second set of JSON data.
     */
    private $data2;

    /**
     * DataManipulator constructor.
     *
     * @param array $data1 The first set of JSON data.
     * @param array $data2 The second set of JSON data.
     */
    public function __construct(array $data1, array $data2)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
    }

    /**
     * Manipulate the data and return the result.
     *
     * @return array The manipulated data.
     */
    public function manipulateData(): array
    {
        $manipulatedData = [];

        foreach ($this->data1 as $booking) {
            $manipulatedData[] = $this->transformBookingData($booking);
        }

        usort($manipulatedData, function ($a, $b) {
            return $a['ahass_distance'] <=> $b['ahass_distance'];
        });

        return $manipulatedData;
    }


    /**
     * Transform booking data based on AHASS code.
     *
     * @param array $booking The booking data.
     *
     * @return array The transformed data.
     */
    private function transformBookingData($booking): array
    {
        $ahassData = $this->getAhassData($booking['booking']['workshop']['code']);

        return [
            'name' => $booking['name'],
            'email' => $booking['email'],
            'booking_number' => $booking['booking']['booking_number'],
            'book_date' => $booking['booking']['book_date'],
            'ahass_code' => $ahassData['code'],
            'ahass_name' => $ahassData['name'],
            'ahass_address' => $ahassData['address'],
            'ahass_contact' => $ahassData['phone_number'],
            'ahass_distance' => $ahassData['distance'],
            'motorcycle_ut_code' => $booking['booking']['motorcycle']['ut_code'],
            'motorcycle' => $booking['booking']['motorcycle']['name'],
        ];
    }

    /**
     * Get AHASS data based on code.
     *
     * @param string $ahassCode The AHASS code.
     *
     * @return array The AHASS data.
     */
    private function getAhassData(string $ahassCode): array
    {
        foreach ($this->data2 as $ahass) {
            if ($ahass['code'] === $ahassCode) {
                return $ahass;
            }
        }

        return [
            'code' => '17236',
            'name' => 'AHASS MEGATAMA MOTOR',
            'address' => '',
            'phone_number' => '',
            'distance' => 0,
        ];
    }
}
