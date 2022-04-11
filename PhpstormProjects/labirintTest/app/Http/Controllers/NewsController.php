<?php

namespace App\Http\Controllers;

use App\Models\News;
use DOMDocument;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private const API_KEY = "8d2e19c770e074168d38937673c29e05";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();

        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'anons' => 'required',
            'text' => 'required',
            'tags' => 'required',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')->with('success', 'Новость успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'anons' => 'required',
            'text' => 'required',
            'tags' => 'required',
        ]);

        $news->update($request->all());

        return redirect()->route('news.index')->with('success', 'Новость успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Новость успешно удалена');
    }

    private function getCurse()
    {
        $date = date("d.m.Y");
        $dom = new domDocument("1.0", "cp1251");
        $dom->loadXML(file_get_contents("http://www.cbr.ru/scripts/XML_daily.asp?date_req=$date"));
        $root = $dom->documentElement;
        $childs = $root->childNodes;
        $data = array();
        for ($i = 0; $i < $childs->length; $i++) {
            $childs_new = $childs->item($i)->childNodes;
            for ($j = 0; $j < $childs_new->length; $j++) {
                $el = $childs_new->item($j);
                $code = $el->nodeValue;
                if (($code == "USD") || ($code == "EUR") || ($code == "SEK") || ($code == "JPY") || ($code == "CAD")) {
                    $data[] = $childs_new;
                }
            }
        }
        $array = [];
        for ($i = 0; $i < count($data); $i++) {
            $list = $data[$i];
            for ($j = 0; $j < $list->length; $j++) {
                $el = $list->item($j);
                if ($el->nodeName == "CharCode") {
                    $array['CharCode'][] = '1 ' . $el->nodeValue;
                } elseif ($el->nodeName == "Value") {
                    $array['value'][] = $el->nodeValue . ' RUB';
                } elseif ($el->nodeName == "Name") {
                    $array['name'][] = $el->nodeValue;
                }
            }
        }
        return $array;
    }

    private function getWeather()
    {
        // Ссылка для отправки
        $url = "http://api.openweathermap.org/data/2.5/weather?q=Moscow&lang=ru&units=metric&appid=fe57b721fd47b8600afac45a7829c1ea";
        // Создаём запрос
        $ch = curl_init();
        // Настройка запроса
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        // Отправляем запрос и получаем ответ
        $data = json_decode(curl_exec($ch));
        // Закрываем запрос
        curl_close($ch);
        return (array)$data;
    }

    public function getData()
    {
        $result = [
            'curse' => $this->getCurse(),
            'weather' => $this->getWeather()
        ];
        return view('task1', ['data' => $result]);
    }
}
