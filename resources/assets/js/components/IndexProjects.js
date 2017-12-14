import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class IndexProjects extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Projects List</div>

                            <div className="panel-body">
                            <table className="table table-hover">
                                <thead>
                                <tr>
                                    <td>Name</td>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('indexprojects')) {
    ReactDOM.render(<IndexProjects />, document.getElementById('indexprojects'));
}
