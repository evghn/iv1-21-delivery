<?php

namespace app\modules\account\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Favourite;
use Yii;

/**
 * FavouriteSearch represents the model behind the search form of `app\models\Favourite`.
 */
class FavouriteSearch extends Favourite
{
    public string $product_category = '';
    public string $product_title = '';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'user_id', 'status'], 'integer'],
            [['product_category', 'product_title'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            ...parent::attributeLabels(),
            'product_category' => 'Категория товара',
            'product_title' => 'Название товара',
        ];
    }
    /**
     * {@inheritdoc}
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
        $query = Favourite::find()
            ->joinWith([
            'product' => fn($q) => $q->joinWith('category')
            
            //  => function($query) {
            //     $query->andWhere(['user_id' => Yii::$app->user->id]);
            // },
    ])
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    /* 
                    // catalog
                    'tile',
                    'count'
                    'price',
                     */
                    
                    'product_title' => [
                        'asc' => ['product.title' => SORT_ASC],
                        'desc' => ['product.title' => SORT_DESC],
                        'default' => SORT_ASC,                        
                    ],
                    
                    'product_category' => [
                        'asc' => ['category.title' => SORT_ASC],
                        'desc' => ['category.title' => SORT_DESC],
                        'default' => SORT_ASC,                        
                    ],
                    
                ],
            ]
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
            'product_id' => $this->product_id,
            'user_id' => Yii::$app->user->id,
            'status' => 1,
            'product.category_id' => $this->product_category,            
        ])
            ->andFilterWhere(['like', 'product.title', $this->product_title])
            ;

        return $dataProvider;
    }
}
