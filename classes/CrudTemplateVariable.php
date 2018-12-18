<?php


namespace Davidany\CodeGen;

use PDO;

class CrudTemplateVariable
{

	public $projectTableNames;
	public $dbCredential;
	public $projectId;
	public $projectColumnNames;
	public $crudValueArray = [];

	public function build($dbCredential, $projectId)
	{
		$this->dbCredential = $dbCredential;
		$this->projectId    = $projectId;
		$this->getTablesAndColumns();
//		print_x($this->crudValueArray);
	}

	public function getTablesAndColumns()
	{

		$dbProject = DB::getInstance($this->dbCredential->database, $this->dbCredential->host, $this->dbCredential->username, $this->dbCredential->password);
//		die();
		$sql  = "SHOW TABLES FROM {$this->dbCredential->database}";
		$stmt = $dbProject->prepare($sql);
		$stmt->execute();
		$this->projectTableNames = $stmt->fetchAll(PDO::FETCH_COLUMN);

		foreach ($this->projectTableNames as $tableKey => $tableName) {

			$dbProject = DB::getInstance($this->dbCredential->database, $this->dbCredential->host, $this->dbCredential->username, $this->dbCredential->password);
			$sql       = "SHOW COLUMNS  FROM $tableName";
			$stmt      = $dbProject->prepare($sql);
			$stmt->execute();
			$this->projectColumnNames = $stmt->fetchAll(PDO::FETCH_COLUMN);

			$capitalizedTableNameWithoutUnderscoresPlural   = str_replace('_', '', ucwords($tableName, '_'));
			$capitalizedTableNameWithSpacesPlural           = str_replace('_', ' ', ucwords($tableName, '_'));
			$unCapitalizedTableNameWithoutUnderscoresPlural = str_replace('_', '', ucwords($tableName, '_'));
			$unCapitalizedTableNameWithoutUnderscoresPlural = lcfirst($unCapitalizedTableNameWithoutUnderscoresPlural);

			// singularize table names
			$singularTableName = Inflect::singularize($tableName);

			// remove underscores
			$capitalizedTableNameWithoutUnderscores = str_replace('_', '', ucwords($singularTableName, '_'));
			$capitalizedTableNameWithDashes         = str_replace('_', '-', ucwords($singularTableName, '_'));
			$unCapitalizedTableNameWithDashes       = str_replace('_', '-', ($singularTableName));


			// uncapitalize first letter
			$unCapitalizedTableNameWithoutUnderscores = lcfirst($capitalizedTableNameWithoutUnderscores);


			$this->crudValueArray[$tableKey]['tableName']                 = $tableName;
			$this->crudValueArray[$tableKey]['ControllerName']            = $capitalizedTableNameWithoutUnderscores . 'Controller';
			$this->crudValueArray[$tableKey]['ControllerVariableName']    = $unCapitalizedTableNameWithoutUnderscoresPlural;
			$this->crudValueArray[$tableKey]['ControllerCompactName']     = $unCapitalizedTableNameWithoutUnderscoresPlural;
			$this->crudValueArray[$tableKey]['ViewDisplayTableName']      = $capitalizedTableNameWithSpacesPlural;
			$this->crudValueArray[$tableKey]['ViewClassVariablePlural']   = $unCapitalizedTableNameWithoutUnderscoresPlural;
			$this->crudValueArray[$tableKey]['ViewClassVariableSingular'] = $unCapitalizedTableNameWithoutUnderscores;

			$this->crudValueArray[$tableKey]['singularTableName']                              = $singularTableName;
			$this->crudValueArray[$tableKey]['capitalizedTableNameWithoutUnderscoresPlural']   = $capitalizedTableNameWithoutUnderscoresPlural;
			$this->crudValueArray[$tableKey]['unCapitalizedTableNameWithoutUnderscoresPlural'] = $unCapitalizedTableNameWithoutUnderscoresPlural;
			$this->crudValueArray[$tableKey]['unCapitalizedTableNameWithoutUnderscores']       = $unCapitalizedTableNameWithoutUnderscores;
			$this->crudValueArray[$tableKey]['capitalizedTableNameWithoutUnderscores']         = $capitalizedTableNameWithoutUnderscores;
			$this->crudValueArray[$tableKey]['unCapitalizedTableNameWithDashes']               = $unCapitalizedTableNameWithDashes;
			$this->crudValueArray[$tableKey]['capitalizedTableNameWithDashes']                 = $capitalizedTableNameWithDashes;
			$this->crudValueArray[$tableKey]['ControllerName']                                 = $capitalizedTableNameWithoutUnderscores . 'Controller';
			$this->crudValueArray[$tableKey]['ModelClassName']                                 = $capitalizedTableNameWithoutUnderscores;
			$this->crudValueArray[$tableKey]['ViewFolderName']                                 = $unCapitalizedTableNameWithDashes;
			$this->crudValueArray[$tableKey]['RouteModelName']                                 = $unCapitalizedTableNameWithDashes;
			$this->crudValueArray[$tableKey]['Factory']                                        = $tableName;
			$this->crudValueArray[$tableKey]['MigrationTableName']                             = $tableName;

			$this->crudValueArray[$tableKey]['ViewIndexColumnTitleTR'] = '';
			$this->crudValueArray[$tableKey]['ViewIndexColumnValueTR'] = '';
			foreach ($this->projectColumnNames as $columnKey => $columnName) {
				$displayColumnName                                         = str_replace('_', ' ', ucwords($columnName, '_'));
				$this->crudValueArray[$tableKey]['Columns'][$columnKey]['ColumnName']    = $columnName;
				$this->crudValueArray[$tableKey]['Columns'][$columnKey]['ColumnDisplayName']    = $displayColumnName;
				$displayColumnName                                         = str_replace('_', ' ', ucwords($columnName, '_'));
				$this->crudValueArray[$tableKey]['ViewIndexColumnTitleTR'] .= '<td scope="col">' . $displayColumnName . '</td>';
				$this->crudValueArray[$tableKey]['ViewIndexColumnValueTR'] .= '<td>{{$' . $unCapitalizedTableNameWithoutUnderscores . '["' . $columnName . '"]}}</td>';


			}
		}
//		print_x($this->crudValueArray);

	}

}