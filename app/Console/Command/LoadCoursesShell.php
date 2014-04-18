<?php

define('EXPLORECOURSES_SCHOOL_URL', 'http://explorecourses.stanford.edu/?view=xml-20120105');
define('EXPLORECOURSES_DEPARTMENT_URL', 'http://explorecourses.stanford.edu/search?view=xml-20140304&filter-coursestatus-Active=on&page=%d&catalog=&q=%s');

App::Import('ConnectionManager');

class LoadCoursesShell extends AppShell {
    public $uses = array('Department', 'Klass', 'GradingStyle');

    public $grading_styles = array(
        'Letter (ABCD/NP)' => 1,
        'Letter or Credit/No Credit' => 2,
        'Satisfactory/No Credit' => 3,
        'Credit/No Credit' => 7,
    );

    public function main() {
        $departments = $this->load_departments();

        foreach ($departments as $department => $id) {
            $classes = $this->load_all_classes($id, $department);
            $this->Klass->saveAll($classes);
            echo 'Completed department ' . $department . "\n";
        }
    }

    private function load_departments() {
        $school_data = $this->get(EXPLORECOURSES_SCHOOL_URL);

        $departments = [];
        $department_codes = [];
        foreach ($school_data as $school) {
            foreach ($school->department as $department) {
                if (in_array($department['name'], $department_codes))
                    continue;

                $departments[] = array(
                    'code' => (string) $department['name'],
                    'name' => (string) $department['longname']
                );
                $department_codes[] = (string) $department['name'];
            }
        }

        if (!$this->Department->saveAll($departments))
            trigger_error('Department save failed');

        // Now create a mapping department code => DB department ID
        $department_mappings = array_combine($department_codes,
            $this->Department->inserted_ids);
        return $department_mappings;
    }

    private function load_all_classes($department_id, $department_code) {
        $classes = [];
        $page = 0;
        do {
            $class_page_url = sprintf(EXPLORECOURSES_DEPARTMENT_URL, $page,
                $department_code);
            $class_page = $this->get($class_page_url);

            foreach ($class_page->courses->course as $class_el) {
                $data = array(
                    'department_id' => $department_id,
                    'code' => (integer) $class_el->code,
                    'name' => (string) $class_el->title,
                    'description' => (string) $class_el->description,
                    'units_min' => (integer) $class_el->unitsMin,
                    'repeatable_for_credit' => (boolean) $class_el->repeatable,
                    'grading_style_id' => $this->get_grading_style_id((string) $class_el->grading),
                );

                if ((integer) $class_el->unitsMax > (integer) $class_el->unitsMin)
                    $data['units_max'] = (integer) $class_el->unitsMax;

                $classes[] = $data;
            }

            $page++;
        } while ($class_page->courses->course->count() > 0);

        return $classes;
    }

    private function get_grading_style_id($style) {
        if (!array_key_exists($style, $this->grading_styles)) {
            $grading_style = array('description' => $style);
            $this->GradingStyle->create($grading_style);
            $this->GradingStyle->save();
            $this->grading_styles[$style] = $this->GradingStyle->getLastInsertId();
        }

        return $this->grading_styles[$style];
    }

    private function get($url) {
        $result = simplexml_load_file($url);
        while (empty($result)) {
            echo "\tRetry\n";
            $result = simplexml_load_file($url);
            sleep(2);
        }

        return $result;
    }

    /* private function group_classes($classes) { */
    /*     $grouped = []; */
    /*     foreach ($classes as $class) { */
    /*         if (array_key_exists($class['cleaned_name'], $grouped)) { */
    /*             $grouped[$class['cleaned_name']]['codes'][] = $class['code']; */

    /*             // DEV: Hopefully nature of class doesn't change across codes */
    /*             $gver = $grouped[$class['cleaned_name']]; */
    /*             foreach (['units_min', 'units_max', 'repeatable_for_credit', 'grading_style_id', 'description'] as $key) { */
    /*                 if ($gver[$key] != $class[$key]) { */
    /*                     echo "MISMATCH\n"; */
    /*                     var_dump($gver, $class); */
    /*                 } */
    /*             } */
    /*         } else { */
    /*             $class['codes'] = [$class['code']]; */
    /*             unset($class['code']); */
    /*             $grouped[$class['cleaned_name']] = $class; */
    /*         } */
    /*     } */

    /*     return $grouped; */
    /* } */

    /* private function save($classes_grouped, $departments) { */
    /*     foreach ($classes_grouped as $class) { */
    /*         $class['name'] = $class['cleaned_name']; */
    /*         $data = array('Klass' => $class, 'KlassCode' => []); */

    /*         foreach ($class['codes'] as $code) { */
    /*             $code_data = array( */
    /*                 'department_id' => $departments[$code[0]], */
    /*                 'klass_code' => $code[1] */
    /*             ); */

    /*             $found = false; */
    /*             foreach ($data['KlassCode'] as $existing) */
    /*                 if ($existing == $code_data) */
    /*                     $found = true; */

    /*             if (!$found) */
    /*                 $data['KlassCode'][] = $code_data; */
    /*         } */

    /*         $ret = $this->Klass->saveAssociated($data); */
    /*         if ($ret !== true) */
    /*             var_dump($ret); */
    /*     } */
    /* } */

    /* private function clean_class_name($class_name) { */
    /*     return preg_replace('/^(.+) \(([A-Z\d\s,]+)\)$/', '$1', $class_name); */
    /* } */
}