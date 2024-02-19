<?php

/**
 *  Include dataProvider for tests
 * @group headless
 */
class CRM_Member_BAO_QueryTest extends CiviUnitTestCase {

  /**
   * Set up function.
   *
   * Ensure CiviCase is enabled.
   */
  public function setUp(): void {
    parent::setUp();
    CRM_Core_BAO_ConfigSetting::enableComponent('CiviCase');
  }

  /**
   * Check that membership type is handled.
   *
   * We want to see the following syntaxes for membership_type_id field handled:
   *   1) membership_type_id => 1
   */
  public function testConvertEntityFieldSingleValue(): void {
    $formValues = ['membership_type_id' => 2];
    $params = CRM_Contact_BAO_Query::convertFormValues($formValues, 0, FALSE, NULL, ['membership_type_id']);
    $this->assertEquals(['membership_type_id', '=', 2, 0, 0], $params[0]);
    $obj = new CRM_Contact_BAO_Query($params);
    $this->assertEquals(['civicrm_membership.membership_type_id = 2'], $obj->_where[0]);
  }

  /**
   * Check that membership type is handled.
   *
   * We want to see the following syntaxes for membership_type_id field handled:
   *   2) membership_type_id => 5,6
   *
   * The last of these is the format used prior to converting membership_type_id to an entity reference field.
   */
  public function testConvertEntityFieldMultipleValueEntityRef(): void {
    $formValues = ['membership_type_id' => '1,2'];
    $params = CRM_Contact_BAO_Query::convertFormValues($formValues, 0, FALSE, NULL, ['membership_type_id']);
    $this->assertEquals(['membership_type_id', 'IN', [1, 2], 0, 0], $params[0]);
    $obj = new CRM_Contact_BAO_Query($params);
    $this->assertEquals(['civicrm_membership.membership_type_id IN ("1", "2")'], $obj->_where[0]);
  }

  /**
   * Check that membership type is handled.
   *
   * We want to see the following syntaxes for membership_type_id field handled:
   *   3) membership_type_id => array(5,6)
   *
   * The last of these is the format used prior to converting membership_type_id to an entity reference field. It will
   * be used by pre-existing smart groups.
   */
  public function testConvertEntityFieldMultipleValueLegacy(): void {
    $formValues = ['membership_type_id' => [1, 2]];
    $params = CRM_Contact_BAO_Query::convertFormValues($formValues, 0, FALSE, NULL, ['membership_type_id']);
    $this->assertEquals(['membership_type_id', 'IN', [1, 2], 0, 0], $params[0]);
    $obj = new CRM_Contact_BAO_Query($params);
    $this->assertEquals(['civicrm_membership.membership_type_id IN ("1", "2")'], $obj->_where[0]);
  }

  /**
   * Check that running convertFormValues more than one doesn't mangle the array.
   *
   * Unfortunately the convertFormValues & indeed much of the query code is run in pre-process AND post-process.
   *
   * The convertFormValues function should cope with this until such time as we can rationalise that.
   */
  public function testConvertEntityFieldMultipleValueEntityRefDoubleRun(): void {
    $formValues = ['membership_type_id' => '1,2'];
    $params = CRM_Contact_BAO_Query::convertFormValues($formValues, 0, FALSE, NULL, ['membership_type_id']);
    $this->assertEquals(['membership_type_id', 'IN', [1, 2], 0, 0], $params[0]);
    $params = CRM_Contact_BAO_Query::convertFormValues($params, 0, FALSE, NULL, ['membership_type_id']);
    $this->assertEquals(['membership_type_id', 'IN', [1, 2], 0, 0], $params[0]);
    $obj = new CRM_Contact_BAO_Query($params);
    $this->assertEquals(['civicrm_membership.membership_type_id IN ("1", "2")'], $obj->_where[0]);
  }

  /**
   * Membership Date fields
   * @return array
   */
  public function membershipDateFields() {
    $fields = [];
    $fields[] = ['membership_join_date'];
    $fields[] = ['membership_start_date'];
    $fields[] = ['membership_end_date'];
    return $fields;
  }

  /**
   * Test generating a correct where clause for date fields as generated by search builder
   * @dataProvider membershipDateFields
   */
  public function testMembershipDateWhereSearchBuilder($dateField) {
    $dbDateField = str_replace('membership_', '', $dateField);
    $formValues = [
      'mapper' => [
        1 => [['Membership', $dateField], [''], [''], [''], ['']],
        2 => [[''], [''], [''], [''], ['']],
        3 => [[''], [''], [''], [''], ['']],
      ],
      'operator' => [
        1 => ['<=', '', '', '', ''],
        2 => ['', '', '', '', ''],
        3 => ['', '', '', '', ''],
      ],
      'value' => [
        1 => ['20200201', '', '', '', ''],
        2 => ['', '', '', '', '', ''],
        3 => ['', '', '', '', '', ''],
      ],
      'radio_ts' => '',
    ];
    $searchBuilderForm = new CRM_Contact_Form_Search_Builder();
    $params = [[$dateField, "<=", "20200201", 1, 0]];
    $this->assertEquals($params, $searchBuilderForm->convertFormValues($formValues));
    $obj = new CRM_Contact_BAO_Query($params);
    $this->assertEquals(['civicrm_membership.' . $dbDateField . ' <= \'20200201000000\''], $obj->_where[1]);
  }

}
