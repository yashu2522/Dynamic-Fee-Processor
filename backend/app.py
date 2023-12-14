from flask import Flask, render_template, jsonify, request
from apis.uploadFee import insertInToSql, bringDataFromServer

app = Flask(__name__)

@app.route('/feeupload')
def feeUpload():
    return render_template('feeupload.html')

@app.route('/uploadData', methods=['POST'])
def uploadData():
    f = request.files['file']
    print(f, type(f))
    insertInToSql(f)
    return "<h1> file uploaded</h1>"#"insertInToSql(request.form['filename'])"

@app.route('/feeretreve')
def feeretreve():
    return render_template('feeretrieval.html')


@app.route('/bringdata', methods= ['POST'])
def bringdata():
    data = request.form
    print(data['year'], data['branch'], data['status'], data)
    return jsonify(bringDataFromServer(data))

if __name__ == "__main__":
    app.run(debug=True, port=5000)