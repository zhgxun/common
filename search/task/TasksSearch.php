<?php

namespace common\search\task;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\task\Tasks;

/**
 * TasksSearch represents the model behind the search form about `common\models\task\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['user_name', 'audit_name', 'task_type', 'ipaddress', 'code_branch', 'data_year', 'command', 'parameters', 'content', 'audit_date', 'task_status', 'audit_status', 'start_date', 'end_date', 'report', 'out_subscribe', 'error_subscribe', 'report_subscribe', 'out_file_path', 'error_file_path', 'report_file_path', 'ctime', 'utime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'audit_date' => $this->audit_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'ctime' => $this->ctime,
            'utime' => $this->utime,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'audit_name', $this->audit_name])
            ->andFilterWhere(['like', 'task_type', $this->task_type])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress])
            ->andFilterWhere(['like', 'code_branch', $this->code_branch])
            ->andFilterWhere(['like', 'data_year', $this->data_year])
            ->andFilterWhere(['like', 'command', $this->command])
            ->andFilterWhere(['like', 'parameters', $this->parameters])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'task_status', $this->task_status])
            ->andFilterWhere(['like', 'audit_status', $this->audit_status])
            ->andFilterWhere(['like', 'report', $this->report])
            ->andFilterWhere(['like', 'out_subscribe', $this->out_subscribe])
            ->andFilterWhere(['like', 'error_subscribe', $this->error_subscribe])
            ->andFilterWhere(['like', 'report_subscribe', $this->report_subscribe])
            ->andFilterWhere(['like', 'out_file_path', $this->out_file_path])
            ->andFilterWhere(['like', 'error_file_path', $this->error_file_path])
            ->andFilterWhere(['like', 'report_file_path', $this->report_file_path]);

        return $dataProvider;
    }
}
