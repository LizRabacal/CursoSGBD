<?php

declare(strict_types=1);

namespace App\Libraries\ticket;

use App\Entities\Ticket;
use App\Enum\TicketChoice;
use DateTime;
use stdClass;

class TicketCalculationService
{

    private Ticket $ticket;


    public function calculate(Ticket $ticket): Ticket
    {

        $this->ticket = $ticket;
        $this->setCurrentSituation();


        return $this->ticket;
    }

    private function setCurrentSituation(): void
    {

        $this->ticket->elapsed_time = $this->elapsedTime();
        $this->ticket->amount_park = $this->calculateAmountPark();
        $this->ticket->amount_due = $this->calculateAmountDue();
        $this->ticket->category_value = $this->ticket->amount_due > 0 ? $this->getCategoryValue() : 0;
    }

    private function elapsedTime(): string
    {

        if ($this->ticket->isClosed()) {
            return  $this->ticket->elapsed_time;
        }

        $calculated = $this->calculateElapsedTime();
        return "{$calculated->hours} horas e {$calculated->minutes} minutos";
    }

    private function calculateAmountPark(): float
    {
        if ($this->ticket->isClosed()) {
            return  $this->ticket->amount_park;
        }

        if ($this->ticket->hasCostumer()) {
            return 0;
        }

        $categoryValue = $this->getCategoryValue();

        $calculated = $this->calculateElapsedTime();

        //ticket diario
        if (TicketChoice::isDaily($this->ticket->choice)) {
            $minutesInOneDay = 1440;

            $days = ($calculated->hours * 60 + $calculated->minutes) / $minutesInOneDay;

            $totalCost = $days * $categoryValue;
            return $totalCost;
        }

        //ticket por hora
        $totalHours = $calculated->hours + ($calculated->minutes / 60);
        $totalCost = $totalHours * $categoryValue;

        return $totalCost;
    }

    private function calculateElapsedTime(): object
    {
        $created_at = new DateTime($this->ticket->created_at->format('Y-m-d H:i:s'));
        $current_time = new DateTime();

        $difference = $current_time->diff($created_at);

        $hours = $difference->h;

        $hours += ($difference->days * 24);

        return (object) ['hours' => $hours, 'minutes' => $difference->i];
    }

    private function getCategoryValue(): int
    {
        if ($this->ticket->isClosed()) {
            return  $this->ticket->category_value;
        }

        $category =  $this->ticket->category;

        if ($category === null) {
            throw new \InvalidArgumentException("A categoria associada ao ticket não pode estar null ou nao foi lozalizada");
        }



        return match ($this->ticket->choice) {
            TicketChoice::Hour->value => $category->price_hour,
            TicketChoice::Day->value => $category->price_day,
            TicketChoice::Month->value => $category->price_month,
            default => throw new \InvalidArgumentException("Tipo não suportado")
        };
    }

    private function calculateAmountDue(): int|float
    {

        if ($this->ticket->isClosed()) {
            return  $this->ticket->amount_paid;
        }

        return $this->calculateAmountPark();
    }
}
