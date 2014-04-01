<?php
App::uses('Component', 'Controller');
/**
 * Stanford-related business logic
 */
class StanfordComponent extends Component {
    const CLASS_QUARTER_AUTUMN = 0;
    const CLASS_QUARTER_WINTER = 1;
    const CLASS_QUARTER_SPRING = 2;
    const CLASS_QUARTER_SUMMER = 3;

    public function __construct() {
        $this->quarter_names = array(
            0 => 'Autumn',
            1 => 'Winter',
            2 => 'Spring',
            3 => 'Summer'
        );

        $this->quarter_starts = array(
            2013 => array(
                self::CLASS_QUARTER_AUTUMN => new DateTime('2013-09-23'),
                self::CLASS_QUARTER_WINTER => new DateTime('2014-01-06'),
                self::CLASS_QUARTER_SPRING => new DateTime('2014-03-31'),
                self::CLASS_QUARTER_SUMMER => new DateTime('2014-06-23')
            ),

            2014 => array(
                self::CLASS_QUARTER_AUTUMN => new DateTime('2014-09-22'),
                self::CLASS_QUARTER_WINTER => new DateTime('2015-01-05'),
                self::CLASS_QUARTER_SPRING => new DateTime('2015-03-30'),
                self::CLASS_QUARTER_SUMMER => new DateTime('2015-06-22')
            ),

            // TODO: rest of time
        );
    }

    public function getCurrentAcademicYear() {
        $now = new DateTime();
        $calendar_year = (int) $now->format('Y');

        // Implied: In autumn quarter, calendar year == academic year of
        // the autumn quarter
        $autumn_start = $this->quarter_starts[$calendar_year]
            [self::CLASS_QUARTER_AUTUMN];

        return ($now < $autumn_start) ? $calendar_year - 1 : $calendar_year;
    }

    public function getCurrentQuarter($academicYear = null) {
        if (empty($academicYear))
            $academicYear = self::getCurrentAcademicYear();

        $now = new DateTime();
        $calendar_year = (int) $now->format('Y');

        $q_starts = $this->quarter_starts[$academicYear];
        if ($q_starts[self::CLASS_QUARTER_SUMMER] < $now)
            return self::CLASS_QUARTER_SUMMER;
        else if ($q_starts[self::CLASS_QUARTER_SPRING] < $now)
            return self::CLASS_QUARTER_SPRING;
        else if ($q_starts[self::CLASS_QUARTER_WINTER] < $now)
            return self::CLASS_QUARTER_WINTER;
        else
            return self::CLASS_QUARTER_AUTUMN;
    }

    public function getQuarterLabel($year, $quarter) {
        $quarter_name = $this->quarter_names[$quarter];

        // Winter quarter overlaps two calendar years
        if ($quarter == 2)
            $year_name = $year . '–' . ($year + 1);
        else
            $year_name = $year;

        return __($quarter_name . ' ' . $year_name);
    }
}