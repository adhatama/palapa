<?php namespace App\Sop;


use Carbon\Carbon;

class EloquentRepository implements RepositoryInterface {

    /**
     * @type phase
     */
    private $phase;

    /**
     * @type Checklist
     */
    private $checklist;

    function __construct(Phase $phase, Checklist $checklist)
    {
        $this->phase = $phase;
        $this->checklist = $checklist;
    }

    public function all()
    {
        return $this->phase->orderBy('ordinal')->get();
    }

    public function incrementPhase($case, $checklist)
    {
        $currentPhase = $checklist->phase;
        $nextPhase = $currentPhase->nextPhase();

        if($nextPhase)
        {
            // close current phase
            $case->closeCurrentPhase();

            // update current phase
            $case->phase()->associate($nextPhase)->save();

            // add new phase to history
            $case->phaseHistory()->attach($nextPhase, ['start_date' => new Carbon()]);
        }
        else
        {
            $case->close();
        }

        return true;
    }
}
