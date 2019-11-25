<?php

namespace App\EventSubscriber;

use App\Repository\AppointmentRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

//LISTENER
class CalendarSubscriber implements EventSubscriberInterface
{
    private $router;
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository,
                                UrlGeneratorInterface $router
                                ) 
    {
        $this->appointmentRepository = $appointmentRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();
        // query
        $appointments = $this->appointmentRepository
            ->createQueryBuilder('appointment')
            ->where('appointment.date BETWEEN :start and :end OR appointment.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;
        foreach ($appointments as $appointment) {
            // this create the events with your data (here appointment data) to fill calendar
            $appointmentEvent = new Event(
                $appointment->getPatient()->getLastName(), //setTitle()
                $appointment->getDate(), //setStart()
                $appointment->getEndAt() //setEnd() -- If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $appointmentEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            /*
            if user->isManager
            $appointmentEvent->addOption(
                'url',
                $this->router->generate('appointment_show', [
                    'id' => $appointment->getId(),
                ])
            );
            */
            // finally, add the event to the CalendarEvent to fill the calendar             
            $calendar->addEvent($appointmentEvent);
        }
    }
}